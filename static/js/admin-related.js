;(function(){
  tinymce.create('tinymce.plugins.related', {

    init : function(ed, url) {
      ed.addCommand('related', function() {
        selected = tinyMCE.activeEditor.selection.getContent();

          content =  '[related id="" headline="auto"]';

        ed.execCommand('mceInsertContent', false, content);
      });

      ed.addButton('related', {
        title : 'Place a Related link',
        cmd : 'related',
      });
    },

    createControl : function(n, cm) {
      return null;
    },

    getInfo : function() {
      return {
        longname : 'Hechinger Related Button',
        author : 'Ups',
        version : "0.1"
      };
    }
  });

  // Register plugin
  tinymce.PluginManager.add('related', tinymce.plugins.related);
}());
