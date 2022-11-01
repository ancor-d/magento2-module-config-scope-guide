pipeline {
  agent {
    kubernetes {
      defaultContainer 'magento'
      yamlFile 'KubernetesPod.yml'
    }
  }
  stages {
    stage('Prepare') {
      environment {
        ANCORD_REPO = credentials('ancord-packagist')
      }
      steps {
        sh '''
           composer config --global -a http-basic.repo.packagist.com "$ANCORD_REPO_USR" "$ANCORD_REPO_PSW"
           '''
        sh 'composer install --dev --prefer-dist --no-interaction --no-progress'
      }
    }
    stage('Tests') {
	  steps {
          sh 'vendor/bin/phing lint-ci' // so we can compile later but also get checkstyles if there's an issue
          sh 'vendor/bin/phing test-ci' // generates reports in build/reports dir
          recordIssues enabledForFailure: true, publishAllIssues: true, tool: checkStyle(pattern: 'build/reports/*-checkstyle.xml'), qualityGates: [[threshold: 1, type: 'TOTAL', unstable: true]]
          junit testResults: 'build/reports/phpunit-junit.xml', allowEmptyResults: true
          sh 'git clean -fdx -e build'
        }
	}
  }
}
