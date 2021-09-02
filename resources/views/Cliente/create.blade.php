<form action ='{{ url('Cliente') }}' class="form-horizontal" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    @include('Cliente.form',['Modo'=>'crear'])

</form>
