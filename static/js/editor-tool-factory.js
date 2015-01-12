;(function(tinyMCE, tinymce){
  "use strict";

  // TODO: refoctor to combine initializations
  function editorToolInit() {

    var builtTool;
    var toolObject = {

      // custom shortcode init function or generic shortcode function
      init: function(ed, url) {

        // Aside Button
        ed.addCommand('aside', function() {
          var selected = tinyMCE.activeEditor.selection.getContent();
          var content =  '[aside num="" notes=""]';
          ed.execCommand('mceInsertContent', false, content);
        });

        ed.addButton('aside', {
          title : 'Place An Aside',
          cmd : 'aside',
        });

        // Related Button
        ed.addCommand('related', function() {
          var selected = tinyMCE.activeEditor.selection.getContent();
          var content =  '[related id="" headline="auto"]';
          ed.execCommand('mceInsertContent', false, content);
        });

        ed.addButton('related', {
          title : 'Place a Related link',
          cmd : 'related',
        });

        // PullQuote Button
        ed.addCommand('pullquote', function() {
          var selected = tinyMCE.activeEditor.selection.getContent();
          var content = "";

          if(selected) {
            content = '[pullquote author="" description="" style="new-pullquote"]' + selected + '[/pullquote]';
          } else {
            content =  '[pullquote author="" description="" style="new-pullquote"]Pull Quote Goes Here[/pullquote]';
          }
          ed.execCommand('mceInsertContent', false, content);
        });

        ed.addButton('pullquote', {
          title : 'Add a Pull Quote',
          cmd : 'pullquote',
        });
      },

      createControl: function(n, cm) {
        return null;
      },

      getInfo : function() {
        return {
          longname : 'Hechinger Editor Buttons',
          author : 'Upstatement',
          version : "0.2"
        };
      }
    };

    builtTool = tinymce.create('tinymce.plugins.editorTools', toolObject);
    return tinymce.PluginManager.add('editor_button_script', tinymce.plugins.editorTools);
  }

  editorToolInit();

}(window.tinyMCE, window.tinymce));
