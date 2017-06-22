<?php

namespace App\Solution3;

class Collection extends \Illuminate\Database\Eloquent\Collection
{
    /**
     * Cache a query to stop it producing twice - seems to be an Eloquent query/collection bug?
     *
     * @var array
     */
    protected static $loadedDeps = [];

    /**
     * Run as normal, but trigger a post-load.
     *
     * @param array|mixed $items
     */
    public function __construct($items)
    {
        parent::__construct($items);

        if (!$this->count()) {
            return;
        }

        $allKeys = join(',', $this->modelKeys());
        if (array_key_exists($allKeys, static::$loadedDeps)) {
            return;
        }

        // Query with IDs from items
        $results = \DB::table('patient_values AS t')
            ->select('t.*')
            ->leftJoin('patient_values AS t2', function ($join) {
                $join->on('t.patient_id', '=', 't2.patient_id')
                    ->on('t.patient_field_id', '=', 't2.patient_field_id')
                    ->on('t.id', '<', 't2.id');
            })
            ->whereRaw('t2.id IS NULL AND t.patient_id IN(' . join(',', array_pad([], count($this->items), '?')) . ')', $this->modelKeys())
            ->orderBy('t.patient_id', 'ASC')
            ->orderBy('t.patient_field_id', 'ASC')
            ->get()->toArray();

        // Cache the results
        static::$loadedDeps[$allKeys] = $results;

        // Compile the results
        $results = $this->compileResults($results, 'patient_id');

        // Go through and add a new collection to each item
        foreach ($this->items as $item) {

            if (array_key_exists($item->id, $results) && !empty($results[$item->id])) {
                $item->setValues($results[$item->id]);
            }
        }
    }

    protected function compileResults(array $results, $key)
    {
        $newArr = [];
        foreach ($results as $result) {
            $result = (array)$result;
            if (!array_key_exists($result[$key], $newArr)) {
                $newArr[$result[$key]] = [];
            }
            $newArr[$result[$key]][] = new PatientValue($result);
        }

        return $newArr;
    }
}