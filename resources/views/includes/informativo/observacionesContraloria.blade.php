<b>Observaciones de Contraloría:</b>
<div class="row">
    <div class="col-md-12">
        <textarea name="obras" id="editorContraloriaObservaciones">
            {{ isset($empresa->observaciones->contraloria)? $empresa->observaciones->contraloria : 'Contraloría no ha hecho alguna Observación' }}
        </textarea>
        <script>
            window.addEventListener("load", (e)=>{
                ClassicEditor.create( document.querySelector( '#editorContraloriaObservaciones' ),{
                    language: 'es',
                } )
                .then( editor => {
                    editor.isReadOnly; // `false`.
                                    editor.enableReadOnlyMode( '#editorContraloria' );
                                    const toolbarElement = editor.ui.view.toolbar.element;
                                    toolbarElement.style.display = 'none';
                } )
                .catch( error => {
                    console.error( error );
                } );
            });
    </script>
    </div>
</div>
