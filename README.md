# Collective
**Secure Story Sharing Webapp**

The Collective web application will enable the sharing of encrypted text among users of the system. All text will be encrypted and inaccessible for the admin. A user can enter and store text associated with their username into the database. This text is only unencrypted for the user who owns it, but the user who owns it can also share access to the unencrypted text to other users by their username. The owner can also remove the access granted to other users. In this way, we have a secure information sharing platform. I imagine writers, journalists, doctors, and scientists using the Collective web app to share their ideas and works in progress with their peers. In return the Collective web app would ensure the security of user’s data. The users own their data, Collective provides the service of keeping that data private, even from Collective itself.

## Getting Started

I have 2 VM's in the cloud. Both VM's are running Fedora 26.
+ Web Server: `100.66.1.18`
+ Database Server: `100.66.2.18`

First, let's configure and harden the webserver.
`ssh parksjg@100.66.1.18`

Now, we need to install some things,
`yum install php httpd php-mysqlnd`
this will install Apache, MySql, and PHP.

Start Apache with
`service httpd restart`
and make Apache start on boot
`chkconfig httpd on`

Now stop firewalld and erase it,
`sudo systemctl stop firewalld`
`sudo dnf erase firewalld`

Next, install the firewall-tui and iptables,
`sudo dnf install system-config-firewall-tui`
`sudo dnf install iptables-services`

Run the tui,
`sudo system-config-firewall-tui`

