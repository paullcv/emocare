# STEP 1: Import the necessary modules.
from mediapipe.tasks import python
from mediapipe.tasks.python import text
import sys
from googletrans import Translator
from googletrans import Translator

INPUT_TEXT = sys.argv[2]
model_path = sys.argv[1]
def translate_to_english(text):
    translator = Translator()
    try:
        translation = translator.translate(text, src='es', dest='en')
        return translation.text
    except Exception as e:
        return f"Error en la traducción: {str(e)}"

# Ejemplo de traducción
sentence_en = translate_to_english(INPUT_TEXT)


# STEP 2: Create an TextClassifier object.
base_options = python.BaseOptions(model_asset_path=model_path)
options = text.TextClassifierOptions(base_options=base_options)
classifier = text.TextClassifier.create_from_options(options)

# STEP 3: Classify the input text.
classification_result = classifier.classify(sentence_en)

# STEP 4: Process the classification result. In this case, print out the most likely category.
top_category = classification_result.classifications[0].categories[0]
print(f'{top_category.category_name}')
