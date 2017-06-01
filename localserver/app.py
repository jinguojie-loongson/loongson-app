#-*- coding:utf-8 -*-
# http://www.cnblogs.com/lichmama/p/4928617.html
#author: lichmama
#email: nextgodhand@163.com
#filename: httpd.py
import io
import os
import sys
import urllib
import commands
import json
from BaseHTTPServer import HTTPServer
from SimpleHTTPServer import SimpleHTTPRequestHandler

class MyRequestHandler(SimpleHTTPRequestHandler):
    web_port = 8765;
    protocol_version = "HTTP/1.1"
    server_version = "PSHS/0.1"
    sys_version = "Python/2.7.x"
    target = "D:/web"

    def do_GET(self):
        print "do_GET: " + self.path
        if self.path == "/" or self.path == "/index":
            content = open("signin.html", "rb").read()
            self.send_head(content)
        elif self.path.startswith("/shell"):
            content = self.do_shell(self.path)
            self.send_head(content)
        else:
            path = self.translate_path(self.path)
            if os.path.exists(path):
                extn = os.path.splitext(path)[1].lower()
                content = open(path, "rb").read()
                self.send_head(content, type=self.extensions_map[extn])
            else:
                content = open("404.html", "rb").read()
                self.send_head(content, code=404)
        self.send_content(content)
            
    def do_POST(self):
        if self.path == "/signin":
            data = self.rfile.read(int(self.headers["content-length"]))
            data = urllib.unquote(data)
            data = self.parse_data(data)
            try:
                uid = data["uid"]
                if uid != "":
                    content = open("success.html", "rb").read()
                    content = content.replace("$uid", uid)    
                    self.send_head(content)
                    #do-something-in-backend
                    if not os.path.exists(self.target + "/" + uid):
                        os.mkdir(self.target + "/" + uid)
                else:
                    content = "400, bad request."
                    self.send_head(content, code=400)
            except KeyError:
                content = "400, bad request."
                self.send_head(content, code=400)
        else:
            content="403, forbiden."
            self.send_head(content, code=403)
        self.send_content(content)
    
    def parse_data(self, data):
        ranges = {}
        for item in data.split("&"):
            k, v = item.split("=")
            ranges[k] = v
        return ranges
    
    def send_head(self, content, code=200, type="text/html"):
        self.send_response(code)
        self.send_header("Access-Control-Allow-Origin", "*")
        self.send_header("Content-Type", type)
        self.send_header("Content-Length", str(len(content)))
        self.end_headers()
    
    def send_content(self, content):
        f = io.BytesIO()    
        f.write(content)
        f.seek(0)
        self.copyfile(f, self.wfile)
        f.close()

    # Service: 执行Shell命令
    # 输入：
    #     cmd命令
    # 输出：返回数据JSON格式
    #     errno：命令执行的返回代码
    #     stdout：cmd在本机上执行的标准输出
    #     stderr：cmd在本机上执行的标准错误
    def do_shell(self, path):
        # path: /shell?cmd=ls
        print "-- do_shell -- path=" + path;
#        data = urllib.unquote_plus(path).decode('utf8').split('?')[-1]
        data = path.decode('utf8').split('?')[-1]
        print urllib.unquote_plus(path).decode('utf8')
        data = self.parse_data(data)   # {'cmd': 'ls', 'root': '1'}
        # print(data);
        return self.exec_cmd(urllib.unquote_plus(data['cmd']))

    def exec_cmd(self, cmd):
        print(cmd);
        result = commands.getstatusoutput(cmd)
        print "exec_cmd: " + cmd + " [DONE]";
        return  json.dumps(result)
      
if __name__ == "__main__":
    if len(sys.argv) == 2:
        #set the target where to mkdir, and default "D:/web"
        MyRequestHandler.target = sys.argv[1]
    try:
        server = HTTPServer(("", MyRequestHandler.web_port), MyRequestHandler)
        print "pythonic-simple-http-server started, serving at http://localhost:" + str(MyRequestHandler.web_port);
        server.serve_forever()
    except KeyboardInterrupt:
        server.socket.close()
