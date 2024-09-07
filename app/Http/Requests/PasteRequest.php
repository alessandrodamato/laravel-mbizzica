<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasteRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'content' => 'required|string',
      'title' => 'nullable|string|max:255',
      'visibility' => 'required|integer|in:1,2,3',
      'expiration_date' => 'nullable|date|after:today',
      'password' => 'nullable|string',
      'file' => 'nullable|file|mimes:jpg,png,ico,jpeg,JPG,PNG|max:2048',
    ];
  }

  public function messages(): array
  {
    return [
      'content.required' => 'Il contenuto è obbligatorio.',
      'expiration_date.date' => 'La data di scadenza deve essere una data valida.',
      'expiration_date.after' => 'La data di scadenza deve essere una data futura rispetto ad oggi.',
      'file.mimes' => 'Il file deve essere uno dei seguenti tipi: jpg, png, pdf, doc, docx.',
      'file.max' => 'La dimensione del file non può essere superiore a 2MB.',
    ];
  }
}
