from flask import Flask, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)



@app.route('/ship_cost_api/<mode>/<value>', methods=['GET'])
def calculate_shipping_cost(mode, value):
    try:
        value = float(value)
    except ValueError:
        return jsonify(result="rejected", reason="Error: value must be a numeric value")

    if mode == "weight":
        if value <= 0:
            return jsonify(result="rejected", reason="Error: weight must be greater than 0")
        elif value > 70:
            return jsonify(result="rejected", reason="Maximum weight per package is 70kg")
        else:
            if value <= 1:
                cost = 300
            else:
                cost = 300 + (value - 1) * 50
            return jsonify(result="accepted", cost=cost)
    
    elif mode == "quantity":
        if value <= 0:
            return jsonify(result="rejected", reason="Error: quantity must be greater than 0")
        elif value > 30:
            return jsonify(result="rejected", reason="Maximum number of units per package is 30")
        else:
            if value == 1:
                cost = 300
            else:
                cost = 300 + (value - 1) * 60
            return jsonify(result="accepted", cost=cost)
    
    else:
        return jsonify(result="rejected", reason="Error: mode must be 'quantity' or 'weight'")

if __name__ == '__main__':
    app.run(host='127.0.0.1', port=8080)