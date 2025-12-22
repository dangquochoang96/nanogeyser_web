		function resizeEditor(){
			var height = $(window).height();
			if(height < 50) height = 50;
			var width = $("body").width();
			$("#svg-frame-hold").css("width",width + "px").css("height",height-50 + "px");
		}
		
CKEDITOR.plugins.add( 'svgedit', {
    requires: 'widget',

    icons: 'svgedit',

    init: function( editor ) {
        
		function initEditor(){
				if(document.getElementById('svg-frame-hold')){
					return;
				}
				var url = CKEDITOR.plugins.get( 'svgedit' ).path;
				$("<div id='svg-frame-hold' style='position: fixed;width: 900px; height:600px; background: #000; top: 40px; z-index: 10001;'><iframe id='svg_edit_frame'  style='width: 100%;height: 100%; min-height: 630px;' src='"+url+"'></iframe></div>").appendTo("body");
				$("#svg_edit_frame").focus();
				resizeEditor();
		}
		


        editor.widgets.add( 'svgedit', {
			inline: true,
            button: 'Chèn hình ảnh Vector',

            template:
                '<span class="svgedit" style="display: inline-block;">' +
                '</span>',



           

            upcast: function( element ) {
                return element.name == 'span' && element.hasClass( 'svgedit' );
            },

            init: function() {
				
               var elm = this.element.$;
			   window._cke_elm = elm;
			   this.element.$.ondblclick = function(){
					window._cke_elm = elm;
					initEditor();
					$("#svg_edit_frame").load(function(){
						var svg = $(elm).find("svg").get(0).parentNode.innerHTML;
						document.getElementById('svg_edit_frame').contentWindow.svgCanvas.setSvgString(svg);
					});
			   }
			   if(elm.innerHTML == "") initEditor();
            },

            data: function() {

            }
        } );
    }
} );
window.onresize = function(){ resizeEditor(); }

window.cke_setSVG = function(string){
	if(window._cke_elm){
		window._cke_elm.innerHTML = string;
		$("#svg-frame-hold").remove();
	}
}

window.close_editor = function(){
	$("#svg-frame-hold").remove();
	var svg = $(_cke_elm).find("svg");
	if(!svg||svg.length == 0){
		$(_cke_elm.parentNode).remove();
		_cke_elm = false;
	}
}