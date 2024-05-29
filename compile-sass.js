const sass = require('node-sass');
const fs = require('fs');
const path = require('path');
const chokidar = require('chokidar');
const uglifyjs = require('uglify-js');

// Chemin du répertoire contenant les fichiers SCSS et JS à compiler
const assetsDir = path.join(__dirname, 'assets');

// Chemin du répertoire où les fichiers CSS et JS finaux seront sauvegardés
const distDir = path.join(__dirname, 'assets', 'dist');
const cssDir = path.join(distDir, 'css');
const jsDir = path.join(assetsDir, 'js');
const jsCompiledDir = path.join(distDir, 'js');
const cssFileName = 'main.css'; // Nom du fichier CSS final
const jsFileName = 'main.js'; // Nom du fichier JS final

// Fonction pour concaténer et compiler les fichiers SCSS en un seul fichier CSS
function compileSass() {
    // Lister tous les fichiers SCSS dans le répertoire
    const scssDir = path.join(assetsDir, 'scss');
    fs.readdir(scssDir, (err, files) => {
        if (err) {
            console.error('Erreur de lecture du répertoire SCSS:', err);
            return;
        }
        // Filtrer les fichiers avec l'extension .scss
        const scssFiles = files.filter(file => path.extname(file) === '.scss');

        // Concaténer tous les fichiers SCSS en un seul
        let concatenatedScss = '';
        scssFiles.forEach(file => {
            const filePath = path.join(scssDir, file);
            concatenatedScss += fs.readFileSync(filePath, 'utf8') + '\n';
        });

        // Compiler le SCSS concaténé
        sass.render({
            data: concatenatedScss
        }, (err, result) => {
            if (err) {
                console.error('Erreur lors de la compilation du fichier SCSS:', err);
                return;
            }
            // Sauvegarder le CSS compilé dans le fichier de destination
            const cssFilePath = path.join(cssDir, cssFileName);
            fs.writeFile(cssFilePath, result.css, err => {
                if (err) {
                    console.error('Erreur lors de l\'écriture du fichier CSS:', err);
                    return;
                }
                console.log(`Le fichier CSS a été compilé avec succès: ${cssFilePath}`);
            });
        });
    });
}

// Fonction pour concaténer et minifier les fichiers JS en un seul fichier
function compileJs() {
    // Lister tous les fichiers JS dans le répertoire
    fs.readdir(jsDir, (err, files) => {
        if (err) {
            console.error('Erreur de lecture du répertoire JS:', err);
            return;
        }
        // Filtrer les fichiers avec l'extension .js
        const jsFiles = files.filter(file => path.extname(file) === '.js');

        // Concaténer tous les fichiers JS en un seul
        let concatenatedJs = '';
        jsFiles.forEach(file => {
            const filePath = path.join(jsDir, file);
            concatenatedJs += fs.readFileSync(filePath, 'utf8') + '\n';
        });

        // Minifier le JS concaténé
        const minifiedJs = uglifyjs.minify(concatenatedJs).code;

        // Sauvegarder le JS minifié dans le fichier de destination
        const jsFilePath = path.join(jsCompiledDir, jsFileName);
        fs.writeFile(jsFilePath, minifiedJs, err => {
            if (err) {
                console.error('Erreur lors de l\'écriture du fichier JS:', err);
                return;
            }
            console.log(`Le fichier JS a été compilé avec succès: ${jsFilePath}`);
        });
    });
}

// Fonction pour surveiller les changements de fichiers SCSS et JS
function watchFiles() {
    console.log('Surveillance des fichiers SCSS et JS en cours...');
    chokidar.watch([path.join(assetsDir, 'scss'), jsDir]).on('change', () => {
        console.log('Changements détectés dans les fichiers SCSS ou JS...');
        compileSass();
        compileJs();
    });
}

// Appeler la fonction pour compiler les fichiers SCSS et JS au démarrage
compileSass();
compileJs();

// Lancer la surveillance des fichiers SCSS et JS
watchFiles();
