# {{ project_name }}

{{ project_description }}

## Environments

| Environment | Branch  | URL                          	|
|-------------|---------|-------------------------------|
| Production  | master  | {{ production_url }}          |
| Staging     | staging | {{ stage_url }}  				|
| Development | develop | {{ dev_url }}      			|

## Development Workflow

### Default Branch

`master`

### Branch naming convention

- For bugs - `fix/issue-name` For example, `fix/syntax-errors`
- For features - `feature/feature-name` For example, `feature/home-page`

### Testing

List down tests created for the project and details on how to execute them locally.

- PHP Unit tests if any.
- Behat tests if any.
- GitHub actions/travis/circleci etc. CI test cases if any.

### Coding Standards and Linting

This environment is automatically codesniffed against the [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/) when pushed to Github.

To run codesniffing locally:

`$ wonderpress lint`