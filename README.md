# GraphQL Example

Miro Hudak <mhudak@enscope.com> for PHPUGDD lightning talk in May 2019.

## Installation

The application is usual Symfony 4 web application.

To initialize, perform `composer install`.

Then, as the application uses public IMDB data, it needs to be downloaded
and then the downloaded files needs to be moved to `seed-source` folder
in root folder of the project before executing database initialization
and seeding.

## GraphQL Setup

To enable GraphQL support in your Symfony project, you need to:

- To install GraphQL support, use `composer require overblog/graphql-bundle`
  - accept all contrib recipes
- To enable Graph*i*QL, use `composer require --dev overblog/graphiql-bundle`
  - accept all contrib recipes
  - Graph*i*QL should now be available on `/graphiql`
- To enable auto-generation of classes, refer to `config/graphql.yaml` 
  and enable custom PSR-4 auto-loading in `composer.json`
  - after editing, dump new autoloader using `composer dump-autoload`

This should prepare your environment for a basic GraphQL support.
Next is to create your own *types*, *fields* and *resolvers*.

## Talk Slides & Resources

You can find PDF version of talk slides in `dev-docs` folder along the database model and Insomnia workspace export.

## Questions?

Ask!
