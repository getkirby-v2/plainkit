module.exports = (grunt) ->
  grunt.initConfig
    pkg: grunt.file.readJSON('package.json')

    watch:
      scripts:
        files: '<%= scripts_in %>'
        tasks: ['clean:scripts', 'coffee:compile', 'concat:libs']
        options:
          spawn: false
      sass:
        files: '<%= styles_in %>'
        tasks: ['clean:styles', 'sass:compile']
        options:
          spawn: false

    sass:
      compile:
        options:
          style: 'expanded'
        files:
          '<%= styles_out %>': '<%= styles_in %>'

    coffee:
      compile:
        options:
          join: true
        flatten: true
        expand: true
        sourceMap: true
        files:
          '<%= scripts_out %><%= pkg.name %>.js': ['<%= scripts_in %>']

    concat:
      libs:
        files:
          '<%= scripts_out %>vendor.js': ['<%= scripts_out %>/lib/**/*.js']

    clean:
      scripts: ['<%= scripts_out %>*.js']
      styles: ['<%= styles_out %>*.css']

    uglify:
      target:
        files:
          '<%= scripts_out %><%= pkg.name %>.min.js': '<%= scripts_out %>/<%= pkg.name %>.js'
          '<%= scripts_out %>vendor.min.js': '<%= scripts_out %>/vendor.js'

    assets: 'assets'
    root: '<%= cwd %>'

    # CoffeeScript -> JS
    scripts_in: '<%= assets %>/coffee/**/*.coffee'
    scripts_out: '<%= assets %>/js/'

    # Sass -> CSS
    styles_in: '<%= assets %>/sass/**/*.sass'
    styles_out: '<%= assets %>/css/<%= pkg.name %>.css'

  # Helpers
  grunt.loadNpmTasks 'grunt-contrib-coffee'
  grunt.loadNpmTasks 'grunt-contrib-uglify'
  grunt.loadNpmTasks 'grunt-contrib-watch'
  grunt.loadNpmTasks 'grunt-contrib-concat'
  grunt.loadNpmTasks 'grunt-contrib-clean'
  grunt.loadNpmTasks 'grunt-contrib-sass'

  # Tasks
  grunt.registerTask 'default', ['coffee:compile', 'concat']
  grunt.registerTask 'dev', ['watch']
  grunt.registerTask 'libs', ['concat:libs']
  grunt.registerTask 'build', ['coffee:compile', 'concat:libs', 'uglify']
