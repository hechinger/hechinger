# This is the config.rb file to support Upbase. Move this to your root folder after you bower install.

# Set this to the root of your project when deployed:
http_path = "/"

# And this is where compass will watch and compile stuff when it runs:
# css_dir = "css"
# sass_dir = "scss"
css_dir = "static/css"
sass_dir = "static/scss"
images_dir = "static/img"
javascripts_dir = "static/js"
fonts_dir = "static/fonts"
relative_assets = true

# This line tells compass to look at the Upbase styles in your bower_components dir
add_import_path "static/vendor/Upbase/components"

#line_comments = false

line_comments = true
output_style = :expanded
# output_style = :compact :compressed :nested :expanded
# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

require 'autoprefixer-rails'

on_stylesheet_saved do |file|
  css = File.read(file)
  File.open(file, 'w') do |io|
    io << AutoprefixerRails.process(css)
  end
end
