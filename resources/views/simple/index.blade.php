@extends('_layout')

@section('content')

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Forename</th>
            <th>Surname</th>
            <th>DoB</th>
            <th>Registered</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?= $patient->id ?></td>
                <td><a href="#"><?= $patient->forenames ?></a></td>
                <td><a href="#"><?= $patient->surname ?></a></td>
                <td><?= $patient->date_of_birth->format('d/m/Y') ?></td>
                <td><?= $patient->created_at->format('d/m/Y') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

@endsection