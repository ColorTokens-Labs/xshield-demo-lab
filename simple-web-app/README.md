# Simple Web App

For the Simple Web App, you can just deploy nginx on a Linux server.
For example, on a Ubuntu server this would be:

```
sudo hostnamectl set-hostname swa-web
sudo apt install -y nginx
```

We will be using this server for a C2 demo.  Download this [reverse 
shell script](rev.sh) and set execute permission.

```
chmod +x rev.sh
```


