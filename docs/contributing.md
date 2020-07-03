# How to contribute

We are really glad you're reading this, because we need volunteer developers to help this project becomes real.

Come find us on Slack (slack link). We want you working on things you're excited about.

Here are some important resources:

  * Page (Need to be done) tells you where we are,
  * Page (Need to be done) roadmap
  * Project managment space (Need to be done)
  * Mailing list: Join our developers list
  * Bugs (Need to be done) (where to report them) is where to report them

## Testing

We have a handful of PHPUnit tests. Please write PHPUnit tests for new code you create.

## Submitting changes

Please send a [GitHub Pull Request to Mercury](https://github.com/ShopsUniverse/Mercury/pull/new/master) with a clear list of what you've done (read more about [pull requests](http://help.github.com/pull-requests/)). When you send a pull request, we will love you forever if you include PHPUnit tests. We can always use more test coverage. Please follow our coding conventions (below) and make sure all of your commits are atomic (one feature per commit).

Always write a clear log message for your commits. One-line messages are fine for small changes, but bigger changes should look like this:

    $ git commit -m "[API (Top level domain where change is)][Product (Component)] A brief summary of the commit
    > 
    > A paragraph describing what changed and its impact."

## Coding conventions

Start reading our code and you'll get the hang of it. We optimize for readability:

  * We indent using four spaces (tabs)
  * We ALWAYS put spaces after list items and method parameters (`[1, 2, 3]`, not `[1,2,3]`).
  * This is open source software. Consider the people who will read your code, and make it look nice for them.
  * Refactor often.
  * Program for maintainer.
  * Respect project structure.
  * Avoid more then 3 parameters in methods (except in constructors).


Thanks,
Mercury Team
