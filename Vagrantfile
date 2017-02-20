Vagrant.configure('2') do |config|
  config.vm.provider 'lcx'
  config.vm.box = 'fgrehm/centos-6-64-lxc'
  config.vm.hostname = 'coursenetwork-vagrant.dev'
  config.vm.synced_folder '.', '/vagrant/coursenetwork'

  config.vm.provider :lxc do |lxc|
    lxc.customize 'cgroup.memory.limit_in_bytes', '512M'
  end

  config.ssh.username = config.ssh.password = 'vagrant'

  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true

  config.vm.provision 'shell', path: 'config/deploy/provision.sh'
end

# vagrant plugin install vagrant-hostmanager
# vagrant plugin install vagrant-lxc
# vagrant up
# coursenetwork-vagrant.dev