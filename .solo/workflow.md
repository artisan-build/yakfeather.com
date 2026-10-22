# Workflow — yakfeather_com

Project profile for the `multi-agent-build` skill. The coordinator agent reads this FIRST.

## Phase & mode
- phase: pre-launch (Isolated Mode spike, 2026-10-22)
- default mode: A-autonomous
- merge_policy: merge when CI green (Ed, 2026-10-22). Until the first PR lands CI with tests + static analysis, there is nothing to gate on: that PR merges after the worker's own local gate is green.
- merge method: `gh pr merge --squash --delete-branch`

## Hard gate
- command: `composer ready` (once the scaffold defines it; until then `php artisan test` + phpstan)
- extra suites: none
- monorepo: no

## CI (the merge gate for Mode A)
- status: inadequate — none yet; the first PR adds it
- minimum bar: CI MUST include (1) testing and (2) static analysis.

## Dependency install (fresh worktree)
- command: `composer install --no-interaction`
- post-install: none

## Agent-role constraints and exceptions
- constraints: none
- overrides: none
- invocation quirks: none

## Toolchain conformance
Standing ride-along rule: run the full gate when finalizing every PR; whatever it changes rides along as its own commit.

## Ship details
- branch naming: feat/<slug>
- PR target repo: artisan-build/yakfeather.com
- release / split steps: none

## Plan & coordination
- plan location: ~/Herd/brain/ideas/2026-10-22-isolated-mode.md
- Solo project: yakfeather_com
- run-log: ~/Herd/brain/projects/yakfeather_com/log.md

## Stack notes / quirks
- Laravel app scaffolded from artisan-build/laravel-nodeless (no Node). Deploys to Laravel Cloud; custom domain yakfeather.com on Cloudflare with cloudflare_strategy dns_proxy (see brain playbooks/cloudflare-dns-setup.md).
- Exists to be isolated: it is the PHP app whose domain gets moved to the isolate app and back.
