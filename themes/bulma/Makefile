.ONESHELL:
.DEFAULT: help
.SILENT:

SHELL=bash

.PHONY: help
help: ## Display usage
	echo
	echo "theme-bulma (Silverstripe)"
	echo
	grep -E '^[0-9a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'


.PHONY: watch
watch: ## Run node watch
	npm run watch
