import re

def fix_serialized_php(file_path):
    with open(file_path, 'r', encoding='latin-1') as f:
        data = f.read()
    
    # We want to replace 'glozin' with 'foodforlife' and adjust string lengths
    # PHP serialization for strings is s:length:"string";
    
    def replacer(match):
        content = match.group(2)
        content = content.replace('glozin', 'foodforlife')
        content = content.replace('Glozin', 'FoodForLife')
        content = content.replace('GLOZIN', 'FOODFORLIFE')
        # calculate new length in bytes
        return f's:{len(content.encode("latin-1"))}:"{content}"'

    new_data = re.sub(r's:(\d+):"(.*?)";', replacer, data)
    
    with open('customizer_fixed.dat', 'w', encoding='latin-1') as f:
        f.write(new_data)
    print("Fixed DAT successfully!")

fix_serialized_php('customizer.dat')

