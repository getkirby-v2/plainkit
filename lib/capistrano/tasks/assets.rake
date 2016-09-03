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
      ['app/assets/css/app.css', 'app/assets/js/app.js'].each do |asset|
        upload! asset, "#{release_path}/#{asset}", recursive: true
      end
    end
  end
end
