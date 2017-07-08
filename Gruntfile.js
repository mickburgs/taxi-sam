module.exports = function (grunt) {
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-bowercopy');

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    bowercopy: {
      options: {
        srcPrefix: 'bower_components',
        destPrefix: 'web/assets'
      },
      scripts: {
        files: {
          'js/jquery.js': 'jquery/dist/jquery.js',
          'js/bootstrap.js': 'bootstrap/dist/js/bootstrap.js'
        }
      },
      stylesheets: {
        files: {
          'css/bootstrap.css': 'bootstrap/dist/css/bootstrap.css',
          'css/font-awesome.css': 'components-font-awesome/css/font-awesome.css'
        }
      },
      fonts: {
        files: {
          'fonts': 'components-font-awesome/fonts'
        }
      }
    },
    sass: {
      all: {
        options: {
          outputStyle: 'compressed',
          sourceMap: true
        },
        files: {
          'src/AppBundle/Resources/public/css/style.css': 'src/AppBundle/Resources/sources/sass/style.scss'
        }
      }
    },
    watch: {
      styles: {
        files: [
          'src/AppBundle/Resources/**/*.scss'
        ],
        tasks: ['sass']
      }
    }
  });


  grunt.registerTask('init', ['bowercopy']);
  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['init', 'build', 'watch']);

};