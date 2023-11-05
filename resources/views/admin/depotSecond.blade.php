@extends('template')
@section('content')

<div class="my-3 p-3 bg-body rounded shadow-sm"> 
                     
    <h6 class="border-bottom pb-2 mb-4">Liste des stock</h6>
    <table class="table table-bordered table-hover mt-2">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Code Art</th>
            <th scope="col">Désign</th>
            <th scope="col">Réf BLF FRNS</th>
            <th scope="col">Numero Facture</th>
            <th scope="col">Bon de Livraison</th>
            <th scope="col">Prix A HT</th>
            <th scope="col">Prix A TTC</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Julie</td>
            <td>@mdo</td>
            <td>Tina</td>
            <td>Ando</td>
            <td>Fitahiana</td>
            <td>Fanamby</td>                
            <td>030 
                <a href="#" class="btn btn-info ">Modifier</a>
                <a href="#" class="las la-delet btn btn-danger">Supprimer</a>
            </td>
          </tr>
         
        </tbody>
      </table>
    </div>
@endsection