<form action="{{ url('/Categoria/' . $Categoria->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}{{ method_field('PATCH') }}

    @include('Categoria.form',['Modo'=>'editar'])
</form>

