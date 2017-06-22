@extends('_layout')

@section('content')

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Forename</th>
            <th>Surname</th>
            <th>DoB</th>
            <th>Last Pain</th>
            <th>Last Updated</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?= $patient->id ?></td>
            <td><a href="#"><?= $patient->forenames ?></a></td>
            <td><a href="#"><?= $patient->surname ?></a></td>
            <td><?= date('d/m/Y', strtotime($patient->dob)) ?></td>
            <td><?= $patient->pain ?>/10</td>
            <td><?= date('d/m/Y H:i', strtotime($patient->updated_at)) ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

@endsection