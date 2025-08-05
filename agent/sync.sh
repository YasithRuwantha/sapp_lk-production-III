rsync -avL --progress -e "ssh -i '/Users/sugunan/Documents/key/sapp_web.pem'" /Users/sugunan/Documents/projects/sapp/app/* ubuntu@34.237.12.201:/mnt/disk1/web/sapp_lk/app/
rsync -avL --progress -e "ssh -i '/Users/sugunan/Documents/key/sapp_web.pem'" /Users/sugunan/Documents/projects/sapp/system/Helpers/* ubuntu@34.237.12.201:/mnt/disk1/web/sapp_lk/system/Helpers/
rsync -avL --progress -e "ssh -i '/Users/sugunan/Documents/key/sapp_web.pem'" /Users/sugunan/Documents/projects/sapp/public/theme/html-files/template/assets/css/* ubuntu@34.237.12.201:/mnt/disk1/web/sapp_lk/public/theme/html-files/template/assets/css/
ssh -i '/Users/sugunan/Documents/key/sapp_web.pem' ubuntu@34.237.12.201 'cd /mnt/disk1/web/sapp_lk/; php spark migrate'

#rsync -avL --progress -e "ssh -i '/Users/sugunan/Documents/key/sapp_web.pem'" /Users/sugunan/Documents/projects/sapp/public/theme/html-files/template/assets/css/* ubuntu@34.237.12.201:/mnt/disk1/web/sapp_lk/public/theme/html-files/template/assets/css/