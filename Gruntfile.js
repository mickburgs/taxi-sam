module.exports = function (grunt) {
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-bowercopy');

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
    watch: {
      styles: {
        files: [
          'src/AppBundle/Resources/**/*.scss'
        ],
        tasks: ['sass']
      }
    }
  });


  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['build', 'watch']);

};