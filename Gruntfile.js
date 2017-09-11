module.exports = function (grunt) {
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-bowercopy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
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
    cssmin: {
      target: {
        files: [{
          expand: true,
          cwd: 'src/AppBundle/Resources/public/css',
          src: ['*.css', '!*.min.css'],
          dest: 'src/AppBundle/Resources/public/css',
          ext: '.min.css'
        }]
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


  grunt.registerTask('build', ['sass', 'cssmin']);
  grunt.registerTask('default', ['build', 'watch']);

};