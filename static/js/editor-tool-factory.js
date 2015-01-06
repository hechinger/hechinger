;(function(tinyMCE, tinymce){
  "use strict";

  // TODO: refoctor to combine initializations
  function WP_AdminTool(name, initFunction) {

    var builtTool;
    var toolName = 'tinymce.plugins.' + name;
    var toolObject = {

      // custom shortcode init function or generic shortcode function
      init: typeof initFunction === "function" ? initFunction : function(ed, url) {
        ed.addCommand(name, function() {
          var selected = tinyMCE.activeEditor.selection.getContent();
          var content =  '[' + name + ' id="" notes=""]';
          ed.execCommand('mceInsertContent', false, content);
        });

        ed.addButton(name, {
          title : 'Place a ' + name + ' shortcode',
          cmd : name,
        });
      },

      createControl: function(n, cm) {
        return null;
      },

      getInfo : function() {
        return {
          longname : 'Hechinger ' + name + ' Button',
          author : 'Ups',
          version : "0.1"
        };
      }
    };

    builtTool = tinymce.create(toolName, toolObject);
    return tinymce.PluginManager.add(name, tinymce.plugins[name]);
  }

  var asideTool = new WP_AdminTool('aside', function(ed, url) {
    ed.addCommand('aside', function() {
      var selected = tinyMCE.activeEditor.selection.getContent();
      var content =  '[aside num="" notes=""]';
      ed.execCommand('mceInsertContent', false, content);
    });

    ed.addButton('aside', {
      title : 'Place An Aside',
      cmd : 'aside',
    });
  });

  var relatedTool = new WP_AdminTool('related', function(ed, url) {
    ed.addCommand('related', function() {
      var selected = tinyMCE.activeEditor.selection.getContent();
      var content =  '[related id="" headline="auto"]';
      ed.execCommand('mceInsertContent', false, content);
    });

    ed.addButton('related', {
      title : 'Place a Related link',
      cmd : 'related',
    });
  });

  var pullquoteTool = new WP_AdminTool('pullquote', function(ed, url) {
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
  });

}(window.tinyMCE, window.tinymce));
