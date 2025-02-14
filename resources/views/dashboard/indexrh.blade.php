@extends('layouts.apprh')

@section('title', 'Dashboard')

@push('styles')
<style>
    /* Supprimer les soulignements des liens */
a {
    text-decoration: none;
}

/* Uniformiser la hauteur des cartes */
.dashboard-block {
    height: 100%; /* Assure que toutes les cartes ont une hauteur égale */
    display: flex;
    flex-direction: column;    align-items: left;

    justify-content: space-between;
}

.dashboard-block {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: left;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.dashboard-block i {
    font-size: 2.5rem;
    color: black;
    margin-right: 15px;
}

.dashboard-block h3, .dashboard-block h6 {
    margin-bottom: 0;
}

.dashboard-block p {
    font-size: 1rem;
    color: #6c757d;
    margin-top: 5px;
}

.quick-action-block {
    background-color: #038C4F;
    color: white;
    border-radius: 8px;
    padding: 20px;
}

.quick-action-block .dashboard-block {
    background-color: white;
    border: none;
    box-shadow: none;
    color: black;
}

.quick-action-block h6 {
    color: black;
    font-weight:bold;
}

.quick-action-block p {
    font-size: 0.9rem;
    color: #5E8868FF;
    margin-top: 5px;
}

.statistics-section .dashboard-block {
    background-color: #FAFBFCFF;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: left;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.statistics-section .dashboard-block i {
    font-size: 2.5rem;
    margin-right: 15px;
    color: #5a5c69;
}
.statistics-section .dashboard-block h6 {
    font-size: 1.2rem;
    color: #343a40;
}
.statistics-section .dashboard-block p {
    font-size: 1rem;
    color: #6c757d;
}
</style>
@endpush

@section('content')

@endsection

@push('scripts')
{{-- Ajouter des scripts spécifiques à cette page --}}
@endpush
