$(document).ready(function () {
console.log('Aquí entra al js')
    $('#departamentoClienteInput').on('change', function () {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
        console.log('Aquí entra a la funcion')
        var dpto = $(this).val();
        console.log(dpto);
        dpto = dpto.trim();
        var url = buscarCiudadesRoute.replace(':id', dpto);
        console.log(url);
        $.get(url, function(data){
            console.log('Aquí entra a la funcion 2')
            console.log(data);
            var listaciudades = '<option value="">Seleccione la ciudad</option>';
                for(var i=0; i<data.length;i++)
                    listaciudades+='<option value="'+data[i].IdCiudad+'">'+data[i].Nombre+'</option>';
                    $('#ciudadClienteInput').html(listaciudades);               
        });
    });
});
