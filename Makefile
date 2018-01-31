list:
	@echo "Available commands:"
	@grep "^[^#[:space:]].*:$$" Makefile | sort

setup:
	@composer install
	# @./vendor/silverstripe/framework/sake dev/build "flush=1"
	@cd theme-default && npm install

start:
	@NODE_ENV=dev make gulp

gulp:
	cd theme-default && gulp

release:
	@cd theme-default && gulp build
	@git add -f --all theme-default/js theme-default/css
	@git commit -m "Checking in built assets"

startsolr:
	@cd fulltextsearch-localsolr/server/ && java -jar start.jar &

test:
	@vendor/bin/phpunit
