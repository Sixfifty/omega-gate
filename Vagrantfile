# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "ubuntu/trusty64"
  config.vm.network :private_network, ip: "192.168.33.28"
  config.vm.provision :shell, :path => "install.sh"
  config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777","fmode=666"]
  config.vm.provider "virtualbox" do |v|
    v.memory = 1024
  end

end
