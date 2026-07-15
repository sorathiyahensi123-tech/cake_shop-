import re, glob, os

aos_css = '    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">\n'
aos_js = '    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>\n    <script>AOS.init({duration: 800, once: true});</script>\n'

def replacer(match):
    cls_str = match.group(1)
    classes = cls_str.split()
    aos_attrs = {}
    new_classes = []
    for c in classes:
        if c in ['animate-fade-in-up', 'animate-slide-in-up']:
            aos_attrs['data-aos'] = 'fade-up'
        elif c == 'animate-fade-in-left':
            aos_attrs['data-aos'] = 'fade-left'
        elif c == 'animate-fade-in-right':
            aos_attrs['data-aos'] = 'fade-right'
        elif c == 'animate-bounce-in':
            aos_attrs['data-aos'] = 'zoom-in'
        elif c.startswith('animate-delay-'):
            try:
                delay = int(c.split('-')[-1]) * 100
                aos_attrs['data-aos-delay'] = str(delay)
            except ValueError:
                new_classes.append(c)
        else:
            new_classes.append(c)
            
    res = f'class="{" ".join(new_classes)}"'
    for k, v in aos_attrs.items():
        res += f' {k}="{v}"'
    return res

for f in glob.glob("*.php"):
    with open(f, 'r', encoding='utf-8') as file:
        content = file.read()
    
    if "</head>" not in content:
        continue
        
    orig_content = content
    
    if "aos.css" not in content:
        content = content.replace("</head>", aos_css + "</head>")
        
    if "aos.js" not in content:
        content = content.replace("</body>", aos_js + "</body>")

    content = re.sub(r'class="([^"]*)"', replacer, content)
    
    if content != orig_content:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(content)
        print(f"Updated {f}")
