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
          'js/bootstrap.js': 'bootstrap/dist/js/bootstrap.js',
          'js/moment.js': 'moment/min/moment-with-locales.js',
          'js/bootstrap-datetimepicker.min.js': 'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        }
      },
      stylesheets: {
        files: {
          'css/bootstrap.css': 'bootstrap/dist/css/bootstrap.css',
          'css/font-awesome.css': 'components-font-awesome/css/font-awesome.css',
          'css/bootstrap-datetimepicker.min.css': 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
        }
      },
      fonts: {
        files: {
          'fonts': ['components-font-awesome/fonts', 'bootstrap/fonts'],
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