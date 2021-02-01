# Executables: local only
SYMFONY_BIN   = symfony
DOCKER        = docker
DOCKER_COMP   = docker-compose
SYMFONY       = $(EXEC_PHP) bin/console

HTTP_PORT     = 8000

# Executables
EXEC_PHP      = php
COMPOSER      = composer

## —— 🐝 The Strangebuzz Symfony Makefile 🐝 ———————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Symfony 🎵 ———————————————————————————————————————————————————————————————
sf: ## List all Symfony commands
	$(SYMFONY)

cc: ## Clear the cache. DID YOU CLEAR YOUR CACHE????
	$(SYMFONY) c:c

warmup: ## Warmup the cache
	$(SYMFONY) cache:warmup

fix-perms: ## Fix permissions of all var files
	chmod -R 777 var/*

assets: purge ## Install the assets with symlinks in the public folder
	$(SYMFONY) assets:install public/ --symlink --relative

purge-cache: ## Purge cache and logs
	rm -rf var/cache/* var/logs/*

serve: ## Serve the application with HTTPS support
	$(SYMFONY_BIN) serve -d

unserve: ## Stop the webserver
	$(SYMFONY_BIN) server:stop

analyze:
	vendor/bin/phpcbf --standard=PSR12 src
	vendor/bin/phpcbf --standard=PSR12 tests
	vendor/bin/phpcbf --standard=PSR12 features

tests-unit: ## Run only tests unit
	vendor/bin/simple-phpunit --testsuite unit --stop-on-failure

tests-integration: ## Run only tests integration
	vendor/bin/simple-phpunit --testsuite integration --stop-on-failure

tests-system: ## Run only tests integration
	vendor/bin/simple-phpunit --testsuite system --stop-on-failure

tests-behat: ## Run only tests Behat
	vendor/bin/behat --stop-on-failure

tests-all: \
	tests-behat \
	tests-unit \
	tests-integration