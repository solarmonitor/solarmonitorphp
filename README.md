This repository contains the php, js, and other files used for SolarMonitor.org

<b>Welcome</b><br>
Welcome to the SolarMonitor ReadMe! You'll find here the documentation on the website architecture and hosting specifics. The SolarMonitor website and archive is currently hosted on a Virtual Machine (VM) at the Dublin institute for Advanced Studies (DIAS).

<b>Work with git to improve/test SolarMonitor</b><br>
Firstly, you need to fork the main Solar Monitor repository on Github. This creates your own personal repository that you can edit and experiment with. To do so, you need to clone your fork by opening a terminal on your local machine and entering:

$ git clone https://github.com/yourname/solarmonitorphp.git

You will then have the latest copy of SM PHP code on your local machine. You can edit files, use 'git add' and 'git commit' to commit changes, and 'git push' to push them back to Github. The 'git push' will be sent to YOUR remote repository (you can check your remotes via git remote -v, there should at least be an 'origin' remote, which is your fork on Github).

Your new/updated code is now on your fork on Github. Standard procedure at this stage is to create a pull request into the main solarmonitor repository (you're sending the changes 'upstream' in git jargon). Once/if the pull request is approved, the upstream repository, your fork online and locally will all be the same. From here, everyone on the project can do a git pull of the upstream version, so we're all at the same point.

Next step is to deploy the code (usually into a test version on the live machine at DIAS, but the procedure is the same whether deploying a test version or the live version)

<b>Deploy test version</b><br>
First off, on your local machine you can add a new remote git repository (which is on the web server) called test.

$ git remote add test dperezsuarez@www.solarmonitor.org:solarmonitor-test.git

You may push your code into this directory with:

$ git push test +master:refs/heads/master

This basically says deploy my master branch to the master branch (of the test repository) at DIAS. For this to work, you must know the password of the dperezsuarez account, or ask for your SSH public key to be added to ~/dperezsuarez/.ssh/authorized_keys.

To update the site in the future you just need to do: $ git push test

[SIDE NOTE]
The PHP git repositories on the DIAS machine are 'bare repositories'. Think of them as providing an address/link between your local machine code and the live (or test) code. When you push to the bare repository it simply sends your code onto the DIAS machine. To take a look at the bare repository, log into the DIAS machine with:

ssh dperezsuarez@www.solarmonitor.org

Once connected you should be in home directory where you'll see the bare git repository of solarmonitor-test.git (among others). If you view

$ solarmonitor-test.git/hooks/post-receive

you should see

$ GIT_WORK_TREE=/var/www/test.solarmonitor.org git checkout -f

If you go to that directory you'll see the website php. You should see a symlink amongst the php to the data storage in /mnt/solar/solmon_storage/
[END]

<b>Push new changes to the web</b><br>
Deploy production version Note: The following steps should just be done from your master branch, and not from a development one! The procedure is the very same as pushing to the test bare git repository, as above, but this time you'll be pushing to live code. Firstly, on your machine you can add a new remote git repository called production (or whatever name you choose).

$ git remote add production dperezsuarez@www.solarmonitor.org:solarmonitor.git

and to push the new version:

$ git push production +master:refs/heads/master

For this to work, you must know the password of the dperezsuarez account, or ask for your SSH public key to be added to ~/.ssh/authorized_keys.

To update the site in the future just need to do:

$ git push production

<b>Web server set-up for test</b><br>
Follow these instructions iF you want to create a bare repository on the DIAS machine for testing or any other purpose. Log onto the DIAS machine and type

$ mkdir my_test_bare_repo.git

$ cd my_test_bare_repo.git/

$ git init --bare

This just saves the git information of the repository, but not the data itself (HEAD). A git "hook" is created (as described in the sidenote above). This makes possible to check out directly in our webroot directory. To do so we need to create the following executable script: /my_test_bare_repo.git/hooks/post-receive

GIT_WORK_TREE=/var/www/html/my_test_folder git checkout -f

A push to my_test_bare_repo will send files to my_test_folder. A push
