set sFolderName=%date:~%
set sFolderName="C:\Users\Ilya\YandexDisk\YandexDisk\database\%sFolderName%\"
MD %sFolderName%
set sHost="localhost"
set sUser="root"
set sPassword="root"
set sDumpPath="C:\MAMP\db\mysql\register@002dbd"
xcopy "C:\MAMP\db\mysql\register@002dbd" %sFolderName% /S /E

@echo Finish
@pause