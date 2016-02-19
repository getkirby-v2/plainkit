namespace :assets do
  desc 'Compile Sass and CoffeeScript with Gulp'
  task :compile do
    run_locally do
      execute 'gulp build'
    end
  end

  desc 'Upload Static Assets'
  task :upload do
    on roles(:web) do
      ['assets/css/app.css', 'assets/js/app.js'].each do |asset|
        upload! asset, "#{shared_path}/#{asset}"
      end
    end
  end
end
