.ONESHELL:
.DEFAULT: help
.SILENT:
SHELL=bash


.PHONY: help
help: ## Display usage
	echo
	echo "Silverstripe-Docker"
	echo
	grep -E '^[0-9a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'




.PHONY: install
install: ## Run composer install
	composer install
	vendor/bin/sake dev/build
	vendor/bin/sake dev/tasks/DNADesign-Populate-PopulateTask



.PHONY: queue-clean
queue-clean: install
	vendor/bin/sake dev/tasks/Symbiote-QueuedJobs-Tasks-DeleteAllJobsTask confirm=1



.PHONY: queue-build
queue-build: queue-clean
	vendor/bin/sake dev/tasks/SilverStripe-StaticPublishQueue-Task-StaticCacheFullBuildTask



.PHONY: queue-process
queue-process:
	vendor/bin/sake dev/tasks/ProcessJobQueueTask



.PHONY: npm-install
npm-install: ## Run npm install
	docker run -it -v ${PWD}/themes/bulma:/app -w /app node:alpine npm install



.PHONY: npm-run-build
npm-run-build: npm-install ## Run npm run build
	docker run -it -v ${PWD}/themes/bulma:/app -w /app node:alpine npm run build
	find themes/bulma/*/ -type d -name "node_modules" -prune -o -type f \( -iname \*.css -o -iname \*.jpg -o -iname \*.js \) -exec cp --parents \{\} ./cache \;



.PHONY: deploy
deploy: ## Run static build cache (locally)
	make queue-build
	make queue-process
