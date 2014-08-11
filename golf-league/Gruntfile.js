module.exports = function(grunt) {
  // project configuration
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    clean: ["build/web/"],
    assemble: {
//      assembleHTML: {
//        options: {
//          layout: "src/layouts/html/default.hbs",
//          flatten: true
//        },
//        files: {
//          'build/web/': ['src/pages/*.hbs']
//        }
//      },
      assembleAdmin: {
        options: {
          layout: "src/layouts/php/admin.hbs",
          flatten: true,
          ext: ".php"
        },
        files: {
          'build/web/': ['src/admin/**/*.hbs']
        }
      },
//      assembleMember: {
//        options: {
//          layout: "src/layouts/php/member.hbs",
//          flatten: true,
//          ext: ".php"
//        },
//        files: {
//          'build/web/': ['src/member/**/*.hbs']
//        }
//      },
      assemblePHP: {
        options: {
          layout: "src/layouts/php/default.hbs",
          flatten: true,
          ext: ".php"
        },
        files: {
          'build/web/': ['src/php/**/*.hbs']
        }
      }
    },
    cssmin: {
      add_banner: {
    	  options: {
    		  banner: "/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today('yyyy-mm-dd') %> */"
    	  },
    	  files: {
            'build/web/theme/style.css' : 'src/styles/**/*.css'
    	  }
      }
    },
    uglify: {
      options: {
        banner: "/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today('yyyy-mm-dd') %> */"
      },
      library: {
        files: {
          'build/web/js/golf-league.js': 'lib/**/*.js'
        }
      }
    },
    copy: {
      main: {
        files: [{
          expand: true,
          cwd: 'src/php/',
          src: ['**/*.php'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/admin/',
          src: ['**/*.php'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/member/',
          src: ['**/*.php'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/pages/',
          src: ['**/*.html'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/',
          src: ['images/**/*.*'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/scripts/',
          src: ['**/*.js'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/support/',
          src: ['**/*.*', '**/.htaccess'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/photos/',
          src: ['**/*.*'],
          dest: 'build/web/photos/'
        },
        {
          expand: true,
          cwd: 'src/api/',
          src: ['**/*.*'],
          dest: 'build/web/api/'
        },
        {
          expand: true,
          cwd: 'src/config/',
          src: ['**/*.*'],
          dest: 'build/web/'
        }]
      },
      dev: {
        files: [{
          expand: true,
          cwd: 'src/php/',
          src: ['**/*.php'],
          dest: 'build/web/',
          rename: function(dest, src) {
            if (src.indexOf("config.inc.php") >= 0) {
              return dest + src.substring(0, src.lastIndexOf("/")) + "/config.inc.remote.php";
            } else if (src.indexOf("config.inc.local.php") >= 0) {
              return dest + src.substring(0, src.lastIndexOf("/")) + "/config.inc.php";
            } else {
              return dest + src;
            }
          }
        },
        {
          expand: true,
          cwd: 'src/admin/',
          src: ['**/*.php'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/member/',
          src: ['**/*.php'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/pages/',
          src: ['**/*.html'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/',
          src: ['images/**/*.*'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/scripts/',
          src: ['**/*.js'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/support/',
          src: ['**/*.*', '**/.htaccess'],
          dest: 'build/web/'
        },
        {
          expand: true,
          cwd: 'src/photos/',
          src: ['**/*.*'],
          dest: 'build/web/photos/'
        },
        {
          expand: true,
          cwd: 'src/api/',
          src: ['**/*.*'],
          dest: 'build/web/api/'
        },
        {
          expand: true,
          cwd: 'src/config/',
          src: ['**/*.*'],
          dest: 'build/web/'
        }]
      }
    }
  });
  grunt.loadNpmTasks('assemble');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.registerTask('default', ['clean', 'assemble', 'copy:main', 'cssmin', 'uglify']);
  grunt.registerTask('dev', ['clean', 'assemble', 'copy:dev', 'cssmin', 'uglify']);
};
