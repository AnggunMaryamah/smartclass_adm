@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="cards">
        <div class="card-info card-blue">
            <h4>Total Guru</h4>
            <h2>10</h2>
        </div>
        <div class="card-info card-cyan">
            <h4>Total Siswa</h4>
            <h2>50</h2>
        </div>
        <div class="card-info card-lightblue">
            <h4>Kelas Aktif</h4>
            <h2>5</h2>
        </div>
        <div class="card-info card-yellow">
            <h4>Transaksi</h4>
            <h2>$1,500</h2>
        </div>
    </div>

    <h3>Recent Activity</h3>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Activity</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>Logged in</td>
                <td>2025-09-08</td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>Updated Profile</td>
                <td>2025-09-07</td>
            </tr>
        </tbody>
    </table>
@endsection
