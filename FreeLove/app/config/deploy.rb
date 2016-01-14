set :application, "Free Love"
set :domain,      "85.25.253.205"
set :deploy_to,   "httpdocs/derp69v3"
set :app_path,    "app"
set :user,        "lovelove"
set :use_sudo,    false
set :scm,         :git
set :repository,  "/Users/Keef/Sites/freelove/.git/"
set :deploy_via,  :copy

set :use_composer, true
set :update_vendors, true

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,     [app_path + "/logs", web_path + "/uploads", "vendor"]
set :dump_assetic_assets, true
set :branch, "master"
set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  10

set :deploy_via, :rsync_with_remote_cache

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL

after "deploy", "deploy:cleanup"