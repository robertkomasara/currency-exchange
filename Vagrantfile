Vagrant.configure("2") do |config|
  
  config.vm.provider "virtualbox" do |vb|
    vb.cpus = 4; vb.memory = 2048
  end

  config.vm.box = "generic/ubuntu2204"
  config.vm.synced_folder ".", "/home/vagrant/src"

  config.vm.define "app" do |subconfig|
    
    subconfig.vm.hostname = 'app.local'
    subconfig.vm.post_up_message = 'Host up'

    subconfig.vm.provision "shell", path: "vagrant/provisions/init.sh", privileged: true

  end

end
