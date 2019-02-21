module.exports = function(grunt) {
  // Time how long tasks take. Can help when optimizing build times
  require('time-grunt')(grunt);

  // Load grunt tasks automatically (as long as they start with "grunt")
  require('load-grunt-tasks')(grunt);

  // Configurable paths
  var config = {
    app: 'src',
    dist: 'dist/web'
  };

  // project configuration
  grunt.initConfig({
    config: config,
    pkg: grunt.file.readJSON('package.json'),
    clean: ["<%= config.dist %>/"],
    assemble: {
      assembleHTML: {
        options: {
          layout: "<%= config.app %>/layouts/html/default.hbs",
          flatten: true
        },
        files: {
          '<%= config.dist %>/': ['<%= config.app %>/pages/*.hbs']
        }
      },
      assembleAdmin: {
        options: {
          layout: "<%= config.app %>/layouts/php/admin.hbs",
          flatten: true,
          ext: ".php"
        },
        files: {
          '<%= config.dist %>/': ['<%= config.app %>/admin/**/*.hbs']
        }
      },
      assembleMember: {
        options: {
          layout: "<%= config.app %>/layouts/php/member.hbs",
          flatten: true,
          ext: ".php"
        },
        files: {
          '<%= config.dist %>/member/': ['<%= config.app %>/member/**/*.hbs']
        }
      },
      assemblePHP: {
        options: {
          layout: "<%= config.app %>/layouts/php/default.hbs",
          flatten: true,
          ext: ".php"
        },
        files: {
          '<%= config.dist %>': ['<%= config.app %>/php/**/*.hbs']
        }
      }
    },
    cssmin: {
      add_banner: {
    	  options: {
    		  banner: "/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today('yyyy-mm-dd') %> */"
    	  },
    	  files: {
            '<%= config.dist %>/theme/style.css' : '<%= config.app %>/styles/**/*.css'
    	  }
      }
    },
    uglify: {
      options: {
        banner: "/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today('yyyy-mm-dd') %> */"
      },
      library: {
        files: {
          '<%= config.dist %>/js/golf-league.js': 'lib/**/*.js'
        }
      }
    },
    phpunit: {
      classes: {
        dir: 'test/'
      },
      options: {
        bin: 'vendor/bin/phpunit',
        bootstrap: '<%= config.dist %>/autoload.php',
        configuration: 'test/phpunit.xml',
        colors: true,
        coverage: true
      }
    },
    php: {
      options: {
        livereload: true
      },
      livereload: {
        options: {
          middleware: function(connect) {
            return [
              connect.static(config.app)
            ];
          },
          port: 10090,
          hostname: '0.0.0.0',
          open: false,
          keepalive: true,
          base: '<%= config.dist %>'
        }
      }
    },
    copy: {
      main: {
        files: [{
          expand: true,
          cwd: '<%= config.app %>/php/',
          src: ['**/*.php'],
          dest: '<%= config.dist %>/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/admin/',
          src: ['**/*.php'],
          dest: '<%= config.dist %>/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/member/',
          src: ['**/*.php'],
          dest: '<%= config.dist %>/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/pages/',
          src: ['**/*.html'],
          dest: '<%= config.dist %>/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/',
          src: ['images/**/*.*'],
          dest: '<%= config.dist %>/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/scripts/',
          src: ['**/*.js'],
          dest: '<%= config.dist %>/'
        },
        {
          expand: true,
          cwd: 'src/support/',
          src: ['**/*.*', '**/.htaccess'],
          dest: '<%= config.dist %>/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/photos/',
          src: ['**/*.*'],
          dest: '<%= config.dist %>/photos/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/api/',
          src: ['**/*.*'],
          dest: '<%= config.dist %>/api/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/cms/',
          src: ['**/*.*'],
          dest: '<%= config.dist %>/cms/'
        },
        {
          expand: true,
          cwd: '<%= config.app %>/config/',
          src: ['**/*.*'],
          dest: '<%= config.dist %>/'
        },
        {
          expand: true,
          cwd: '.',
          src: ['composer.json'],
          dest: '<%= config.dist %>/'
        }]
      },
      dev: {
        files: [{
          expand: true,
          cwd: '<%= config.app %>/php/',
          src: ['**/*.php'],
          dest: '<%= config.dist %>/',
          rename: function(dest, src) {
            if (src.indexOf("config.inc.php") >= 0) {
              return dest + src.substring(0, src.lastIndexOf("/")) + "/config.inc.remote.php";
            } else if (src.indexOf("config.inc.local.php") >= 0) {
              return dest + src.substring(0, src.lastIndexOf("/")) + "/config.inc.php";
            } else {
              return dest + src;
            }
          }
        }]
      }
    }
  });
  grunt.loadNpmTasks('assemble');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-phpunit');
  grunt.registerTask('default', ['clean', 'assemble', 'copy:main', 'cssmin', 'uglify', 'phpunit']);
  grunt.registerTask('dev', ['clean', 'assemble', 'copy:main', 'copy:dev', 'cssmin', 'uglify', 'phpunit']);
  grunt.registerTask('serve', 'start the server and preview your app', function (target) {
    grunt.task.run([
      'clean', 'assemble', 'copy:main', 'cssmin', 'uglify', 'phpunit', 'php'
    ]);
  });
};
