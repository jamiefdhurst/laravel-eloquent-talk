@extends('_layout')

@section('content')

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Date/time</th>
            <th>Pain Recorded</th>
            <th>Patient</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($sessions as $session): ?>
        <tr>
            <td><?= $session->id ?></td>
            <td><?= $session->appointment->format('d/m/Y H:i') ?></td>
            <td><?= $session->pain ?>/10</td>
            <td><a href="#"><?= $session->patient->forenames ?> <?= $session->patient->surname ?></a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

@endsection