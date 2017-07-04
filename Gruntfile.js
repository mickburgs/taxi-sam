module.exports = function(grunt) {
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.initConfig({
        sass: {
          all: {
              options: {
                  outputStyle: 'compressed',
                  sourceMap: true
              },
              files: {
                  'app/Resources/public/css/style.css': 'app/Resources/sources/sass/style.scss'
              }
          }
        },
        watch: {
             styles: {
                files: [
                    'app/Resources/**/*.scss'
                ],
                tasks: ['sass']
             }
        }
    });


    grunt.registerTask('build', ['sass']);
    grunt.registerTask('default', ['build', 'watch']);

};