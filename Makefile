# Makefile pour automatiser git commit, push et gestion de tags

# Commit & push tous les changements
git-commit-push:  # Commit & push tous les changements
	@read -p "Enter commit message: " msg; \
	if [ -z "$$msg" ]; then \
		echo "Commit message cannot be empty!"; \
		exit 1; \
	fi; \
	git add .; \
	git commit -m "$$msg"; \
	git push

# Gestion des tags: major, minor, patch
git-tag:  # Gestion des tags: major, minor, patch
	@bash -c '\
	read -p "Tag type (major/minor/patch): " type; \
	last_tag=$$(git tag --sort=-v:refname | head -n 1); \
	if [ -z "$$last_tag" ]; then \
		last_tag="0.0.0"; \
	fi; \
	major=$$(echo $$last_tag | cut -d. -f1); \
	minor=$$(echo $$last_tag | cut -d. -f2); \
	patch=$$(echo $$last_tag | cut -d. -f3); \
	if [ "$$type" = "major" ]; then \
		major=$$((major + 1)); minor=0; patch=0; \
	elif [ "$$type" = "minor" ]; then \
		minor=$$((minor + 1)); patch=0; \
	elif [ "$$type" = "patch" ]; then \
		patch=$$((patch + 1)); \
	else \
		echo "Invalid type: $$type"; exit 1; \
	fi; \
	new_tag="$$major.$$minor.$$patch"; \
	git tag -a "$$new_tag" -m "Release $$new_tag"; \
	git push origin "$$new_tag"; \
	echo "Pushed new tag: $$new_tag"; \
	'


# Affiche l'aide et les descriptions
help:  # Affiche l'aide
	@echo "📖 Makefile commands:"; \
	awk '/^#/{desc=$$0}/^[a-zA-Z0-9_-]+:/{gsub(":", "", $$1); gsub(/^# /, "", desc); printf "%-15s -> %s\n", $$1, desc}' $(MAKEFILE_LIST) | sort
