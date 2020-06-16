FROM node:13

WORKDIR /app

RUN npm install -g nodemon
RUN npm install -g mocha@2.3.1
RUN npm install -g sequelize
RUN npm install -g sequelize-cli

COPY . /app

RUN npm install

ENTRYPOINT [ "node", "/app/src/index.js" ]
