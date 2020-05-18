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



.PHONY: deploy
deploy:
	composer install
	vendor/bin/sake dev/build
	vendor/bin/sake dev/tasks/DNADesign-Populate-PopulateTask
	vendor/bin/sake dev/tasks/SilverStripe-StaticPublishQueue-Task-StaticCacheFullBuildTask
	vendor/bin/sake dev/tasks/ProcessJobQueueTask