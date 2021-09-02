<form action ='{{ url('Categoria') }}' class="form-horizontal" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    @include('Categoria.form',['Modo'=>'crear'])

</form>
