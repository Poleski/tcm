module.exports = function(grunt) {
    grunt.initConfig({
        usebanner: {
            taskName: {
                options: {
                    position: 'top',
                    banner: '/*!\n' +
                    'Theme Name: Methanol\n' +
                    'Theme URI: http://underscores.me/\n' +
                    'Author: Merhanic\n' +
                    'Author URI: http://underscores.me/\n' +
                    'Description: Description\n' +
                    'Version: 1.0.0\n' +
                    'License: GNU General Public License v2 or later\n' +
                    'License URI: LICENSE\n' +
                    'Text Domain: methanol\n' +
                    'Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready\n' +
                    '==================================================\n' +
                    '*/',
                    linebreak: true
                },
                files: {
                    src: ['style.css' ]
                }
            }
        },
        less: {
            all: {
                options: {
                    compress: true,
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]})
                    ]
                },
                files: {
                    "style.css": "less/style.less"
                }
            }
        },
        uglify: {
            my_target: {
                files: {
                    'assets/js/main.min.js': ['assets/js/main.js']
                }
            }
        },
        watch: {
            files: ['*', 'js/main.js'],
            tasks: ['less', 'uglify']
        }
    });

    grunt.registerTask('default', ['less', 'usebanner']);

    grunt.loadNpmTasks('grunt-banner');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
};
