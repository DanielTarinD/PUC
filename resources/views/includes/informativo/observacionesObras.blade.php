<b>Observaciones del Área de Padrón:</b>
<div class="row">
    <div class="col-md-12">
        <textarea name="obras" id="editorObras">
            {{ isset($empresa->observaciones->obras)? $empresa->observaciones->obras : 'Área de Padrón no ha hecho alguna Observación' }}
        </textarea>
        <script>
                window.addEventListener("load", (e)=>{
                    ClassicEditor.create( document.querySelector( '#editorObras' ),{
                        language: 'es',
                    } )
                    .then( editor => {
                        editor.isReadOnly; // `false`.
                                        editor.enableReadOnlyMode( '#editorObras' );
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
<br /><br />
