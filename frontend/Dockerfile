# Usa una imagen oficial de Node
FROM node:18

# Crea el directorio de trabajo
WORKDIR /app

# Copia los archivos de dependencias
COPY package*.json ./

# Instala dependencias
RUN npm install

# Copia el resto del código
COPY . .

# Establece la variable de entorno para el puerto
ENV PORT=3001

# Expone el puerto 3001
EXPOSE 3001

# Comando por defecto
CMD ["npm", "start"]
