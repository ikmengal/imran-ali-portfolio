/**
 *  Form Wizard
 */

'use strict';

(function () {
  const select2 = $('.select2'),
    selectPicker = $('.selectpicker');

  // Wizard Validation
  // --------------------------------------------------------------------
  const wizardValidation = document.querySelector('#wizard-validation');
  if (typeof wizardValidation !== undefined && wizardValidation !== null) {
    // Wizard form
    const wizardValidationForm = wizardValidation.querySelector('#wizard-validation-form');
    // Wizard steps
    const wizardValidationFormStep1 = wizardValidationForm.querySelector('#account-details-validation');
    const wizardValidationFormStep2 = wizardValidationForm.querySelector('#personal-info-validation');
    const wizardValidationFormStep3 = wizardValidationForm.querySelector('#social-links-validation');
    const wizardValidationFormStep4 = wizardValidationForm.querySelector('#equipment-pricing-detail-validation');
    const wizardValidationFormStep5 = wizardValidationForm.querySelector('#document-validation');
    const wizardValidationFormStep6 = wizardValidationForm.querySelector('#sales-associates-reps-involved-validation');
    const wizardValidationFormStep7 = wizardValidationForm.querySelector('#future-upsell-opportunity-validation');
    // Wizard next prev button
    const wizardValidationNext = [].slice.call(wizardValidationForm.querySelectorAll('.btn-next'));
    const wizardValidationPrev = [].slice.call(wizardValidationForm.querySelectorAll('.btn-prev'));

    const validationStepper = new Stepper(wizardValidation, {
      linear: true
    });

    let step1Data = {};
    let step2Data = {};
    let step3Data = {};
    let step4Data = {};
    let step5Data = {};
    let step6Data = {};
    let step7Data = {};

    // Company Information details
    const FormValidation1 = FormValidation.formValidation(wizardValidationFormStep1, {
      fields: {
        formValidationDbaName: {
          validators: {
            notEmpty: {
              message: 'This is a required question'
            }
          }
        },
        formValidationLegalName: {
          validators: {
            notEmpty: {
              message: 'This is a required question'
            }
          }
        },
        formValidationFullName: {
          validators: {
            notEmpty: {
              message: 'Full name is required'
            }
          }
        },
        formValidationBaddress: {
            validators: {
              notEmpty: {
                message: 'The Business Address is required'
              }
            }
        },
        formValidationBproductAndServices: {
            validators: {
              notEmpty: {
                message: 'The Business products and services is required'
              }
            }
        },
        formValidationRegion: {
            validators: {
              notEmpty: {
                message: 'The Region is required'
              }
            }
        },
        formValidationDBAphone_number: {
            validators: {
                notEmpty: {
                    message: 'The Business number is required'
                },
                phone: {
                    message: 'The Business number is not valid for USA/Canada'
                },
                regexp: {
                    // Matches USA/Canada phone numbers with or without country code, e.g., +1 (123) 456-7890 or (123) 456-7890
                    regexp: /^(\+1\s?)?(\(?[0-9]{1}\d{2}\)?)?[-.\s]?[0-9]{1}\d{2}[-.\s]?\d{4}$/,
                    message: 'Please enter a valid phone number for USA or Canada, e.g., +1 (257) 456-7890 or (987) 456-7890'
                }
            }
        },
        formValidationbusinessemail: {
            validators: {
                notEmpty: {
                    message: 'The Business email is required'
                },
                emailAddress: {
                    message: 'The input is not a valid email address'
                }
            }
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          //* Move the error message out of the `input-group` element
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      step1Data = {
        dba_name: wizardValidationFormStep1.querySelector('[name="formValidationDbaName"]').value,
        legal_name: wizardValidationFormStep1.querySelector('[name="formValidationLegalName"]').value,
        full_name: wizardValidationFormStep1.querySelector('[name="formValidationFullName"]').value,
        business_address: wizardValidationFormStep1.querySelector('[name="formValidationBaddress"]').value,
        b_product_services: wizardValidationFormStep1.querySelector('[name="formValidationBproductAndServices"]').value,
        b_region: wizardValidationFormStep1.querySelector('[name="formValidationRegion"]').value,
        b_phone_number: wizardValidationFormStep1.querySelector('[name="formValidationDBAphone_number"]').value,
        email_address: wizardValidationFormStep1.querySelector('[name="formValidationbusinessemail"]').value,
      };
      validationStepper.next();
    });

    // Main Pronciples
    const FormValidation2 = FormValidation.formValidation(wizardValidationFormStep2, {
      fields: {
        formValidationProncipleFullName: {
            validators: {
                notEmpty: {
                    message: 'The full name is required'
                }
            }
        },
        formValidationDateOfBirth: {
            validators: {
                notEmpty: {
                    message: 'The Date of birth is required'
                },
                // regexp: {
                //     // Regex to match MM/DD/YYYY
                //     regexp: /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/,
                //     message: 'Enter a valid date in MM/DD/YYYY format'
                // },
                // callback: {
                //     message: 'Enter a valid date',
                //     callback: function(input) {
                //         // Additional date validation to handle invalid dates like 02/30/2023
                //         const [month, day, year] = input.value.split('/');
                //         const date = new Date(`${year}-${month}-${day}`);
                //         return date && date.getMonth() + 1 == month && date.getDate() == day && date.getFullYear() == year;
                //     }
                // }
            }
        },
        formValidationBusinessType: {
            validators: {
                notEmpty: {
                    message: 'The Business Type is required'
                }
            }
        },
        formValidationOwnershipPercent: {
            validators: {
                notEmpty: {
                    message: 'The Ownership Percent is required'
                }
            }
        },
        formValidationSSN: {
            validators: {
                notEmpty: {
                    message: 'The SSN is required'
                },
                stringLength: {
                    min: 9,
                    max: 9,
                    message: 'The SSN must be exactly 9 digits'
                },
                regexp: {
                    regexp: /^[0-9]+$/,
                    message: 'The SSN must consist of numbers only'
                }
            }
        },
        formValidationFNSNumber: {
            validators: {
                stringLength: {
                    min: 7,
                    max: 7,
                    message: 'The FNS Number must be exactly 7 digits'
                },
                regexp: {
                    regexp: /^[0-9]+$/,
                    message: 'The FNS must consist of numbers only'
                }
            }
        },
        formValidationTaxID: {
            validators: {
                notEmpty: {
                    message: 'The Tax ID is required'
                },
                stringLength: {
                    min: 9,
                    max: 9,
                    message: 'The Tax ID must be exactly 9 digits'
                },
                regexp: {
                    regexp: /^[0-9]+$/,
                    message: 'The Tax ID must consist of numbers only'
                }
            }
        },
        formValidationEIN: {
            validators: {
                stringLength: {
                    min: 9,
                    max: 9,
                    message: 'The EIN must be exactly 9 digits'
                },
                regexp: {
                    regexp: /^[0-9]*$/,
                    message: 'The EIN must contain only numeric values'
                }
            }
        },
        formValidationphoneNumber: {
            validators: {
                notEmpty: {
                    message: 'The phone number is required'
                },
                phone: {
                    message: 'The Business number is not valid for USA/Canada'
                },
                regexp: {
                    // Matches USA/Canada phone numbers with or without country code, e.g., +1 (123) 456-7890 or (123) 456-7890
                    regexp: /^(\+1\s?)?(\(?[0-9]{1}\d{2}\)?)?[-.\s]?[0-9]{1}\d{2}[-.\s]?\d{4}$/,
                    message: 'Please enter a valid phone number for USA or Canada, e.g., +1 (123) 456-7890 or (123) 456-7890'
                }
            }
        },
        formValidationResidentalAddress: {
            validators: {
                notEmpty: {
                    message: 'The Residental address is required'
                }
            }
        },
        formValidationShippingAddress: {
            validators: {
              notEmpty: {
                message: 'The Shipping address is required'
              }
            }
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
        step2Data = {
            p_full_name: wizardValidationFormStep2.querySelector('[name="formValidationProncipleFullName"]').value,
            date_of_birth: wizardValidationFormStep2.querySelector('[name="formValidationDateOfBirth"]').value,
            business_type: wizardValidationFormStep2.querySelector('[name="formValidationBusinessType"]').value,
            ownership_percent: wizardValidationFormStep2.querySelector('[name="formValidationOwnershipPercent"]').value,
            ssn: wizardValidationFormStep2.querySelector('[name="formValidationSSN"]').value,
            fns_number: wizardValidationFormStep2.querySelector('[name="formValidationFNSNumber"]').value,
            tax_id: wizardValidationFormStep2.querySelector('[name="formValidationTaxID"]').value,
            ein: wizardValidationFormStep2.querySelector('[name="formValidationEIN"]').value,
            phone_number_cell_phone: wizardValidationFormStep2.querySelector('[name="formValidationphoneNumber"]').value,
            residental_address: wizardValidationFormStep2.querySelector('[name="formValidationResidentalAddress"]').value,
            shipping_address: wizardValidationFormStep2.querySelector('[name="formValidationShippingAddress"]').value,
        };
        validationStepper.next();
    });

    // Bootstrap Select (i.e Language select)
    if (selectPicker.length) {
      selectPicker.each(function () {
        var $this = $(this);
        $this.selectpicker().on('change', function () {
          FormValidation2.revalidateField('formValidationLanguage');
        });
      });
    }

    // select2
    if (select2.length) {
      select2.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this
          .select2({
            placeholder: 'Select an country',
            dropdownParent: $this.parent()
          })
          .on('change.select2', function () {
            // Revalidate the color field when an option is chosen
            FormValidation2.revalidateField('formValidationCountry');
          });
      });
    }

    // Other Company Information
    const FormValidation3 = FormValidation.formValidation(wizardValidationFormStep3, {
      fields: {
        formValidationCompanyAnnualRevenue: {
            validators: {
                notEmpty: {
                    message: 'This is a required question'
                }
            }
        },
        formValidationMonthlyCardSales: {
            validators: {
                notEmpty: {
                    message: 'This is a required question'
                }
            }
        },
        formValidationAverageTransaction: {
            validators: {
                notEmpty: {
                    message: 'This is a required question'
                }
            }
        },
        formValidationHighestAverageTicket: {
            validators: {
                notEmpty: {
                    message: 'This is a required question'
                }
            }
        },
        formValidationFrequencofHighestAverageTicket: {
            validators: {
                notEmpty: {
                    message: 'This is a required question'
                }
            }
        },
        // formValidationBusinessWebsite: {
        //     validators: {
        //         notEmpty: {
        //             message: 'This is a required question'
        //         },
        //         uri: {
        //             message: 'Enter a valid URL (e.g., https://example.com)'
        //         }
        //     }
        // },
        formValidationCardPresent: {
            validators: {
                notEmpty: {
                    message: 'This is a required question'
                },
                between: {
                    min: 0,
                    max: 100,
                    message: 'The value must be between 0 and 100'
                }
            }
        },
        formValidationCardNotPresent: {
            validators: {
                notEmpty: {
                    message: 'This is a required question'
                },
                between: {
                    min: 0,
                    max: 100,
                    message: 'The value must be between 0 and 100'
                }
            }
        },
        formValidationInternet: {
            validators: {
                notEmpty: {
                    message: 'This is a required question'
                },
                between: {
                    min: 0,
                    max: 100,
                    message: 'The value must be between 0 and 100'
                }
            }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
        step3Data = {
            company_annual_revenue: wizardValidationFormStep3.querySelector('[name="formValidationCompanyAnnualRevenue"]').value,
            monthly_card_sales: wizardValidationFormStep3.querySelector('[name="formValidationMonthlyCardSales"]').value,
            average_transaction: wizardValidationFormStep3.querySelector('[name="formValidationAverageTransaction"]').value,
            highest_average_ticket: wizardValidationFormStep3.querySelector('[name="formValidationHighestAverageTicket"]').value,
            frequencof_highest_average_ticket: wizardValidationFormStep3.querySelector('[name="formValidationFrequencofHighestAverageTicket"]').value,
            business_website: wizardValidationFormStep3.querySelector('[name="formValidationBusinessWebsite"]').value,
            card_present: wizardValidationFormStep3.querySelector('[name="formValidationCardPresent"]').value,
            card_not_present: wizardValidationFormStep3.querySelector('[name="formValidationCardNotPresent"]').value,
            internet: wizardValidationFormStep3.querySelector('[name="formValidationInternet"]').value
        };
        validationStepper.next();
    });

    // Equipment / Pricing Details
    const FormValidation4 = FormValidation.formValidation(wizardValidationFormStep4, {
        fields: {
            formValidationProvider: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            },
            formValidationAgreementType: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            },
            formValidationPricingMethod: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            },
            formValidationInterchangeRate: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            },
            formValidationDebitCharge: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                // eleInvalidClass: '',
                eleValidClass: '',
                rowSelector: '.col-sm-6'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        }
    }).on('core.form.valid', function () {
        step4Data = {
            provider: wizardValidationFormStep4.querySelector('[name="formValidationProvider"]').value,
            agreement_type: wizardValidationFormStep4.querySelector('[name="formValidationAgreementType"]').value,
            lease_term: wizardValidationFormStep4.querySelector('[name="formValidationLeaseTerm"]').value,
            pricing_methods: wizardValidationFormStep4.querySelector('[name="formValidationPricingMethod"]').value,
            interchange_rate: wizardValidationFormStep4.querySelector('[name="formValidationInterchangeRate"]').value,
            debit_charge: wizardValidationFormStep4.querySelector('[name="formValidationDebitCharge"]').value,
        };
        validationStepper.next();
    });

// Reference the radio buttons and lease term container
const agreementTypeRadios = document.querySelectorAll('input[name="formValidationAgreementType"]');
const agreementTerm = document.querySelectorAll('input[name="formValidationLeaseTerm"]');
const leaseTermFieldContainer = document.getElementById('lease_term');

// Function to handle agreement type changes
function toggleLeaseTermValidation() {
    // Get the selected agreement type
    const selectedAgreementType = document.querySelector('input[name="formValidationAgreementType"]:checked')?.value;


    if (selectedAgreementType === 'Lease') {

        // Add required validation for lease term
        FormValidation4.addField('formValidationLeaseTerm', {
            validators: {
                notEmpty: {
                    message: 'Lease term is required when agreement type is Lease',
                },
            },
        });
    } else {
        console.log(leaseTermFieldContainer);

        // Hide the lease term field
        if (!leaseTermFieldContainer.classList.contains('d-none')) {
            // Remove required validation for lease term
            FormValidation4.removeField('formValidationLeaseTerm');
        }
    }
}

// Attach change event listeners to all agreement type radio buttons
agreementTypeRadios.forEach(radio => {
    radio.addEventListener('change', toggleLeaseTermValidation);
});

// Call toggle function on page load to set the initial state
// toggleLeaseTermValidation();


// Attach the change event listener to the agreement type field
// agreementTypeField.addEventListener('change', toggleLeaseTermValidation);

// Call toggle function on page load to ensure initial state
// toggleLeaseTermValidation();


    // Documents
    const FormValidation5 = FormValidation.formValidation(wizardValidationFormStep5, {
        fields: {
            formValidationDriverLicense: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    },
                    file: {
                        maxSize: 10485760, // 10MB in bytes
                        message: 'The file size must be less than or equal to 10MB'
                    }
                }
            },
            formValidationBankingDetails: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    },
                    file: {
                        maxSize: 10485760, // 10MB in bytes
                        message: 'The file size must be less than or equal to 10MB'
                    }
                }
            },
            formValidationMasterBusinessLicense: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    },
                    file: {
                        maxSize: 10485760, // 10MB in bytes
                        message: 'The file size must be less than or equal to 10MB'
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                // eleInvalidClass: '',
                eleValidClass: '',
                rowSelector: '.col-sm-6'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        }
    }).on('core.form.valid', function () {
        step5Data = {
            driver_license: wizardValidationFormStep5.querySelector('[name="formValidationDriverLicense"]').value,
            banking_details: wizardValidationFormStep5.querySelector('[name="formValidationBankingDetails"]').value,
            master_business_license: wizardValidationFormStep5.querySelector('[name="formValidationMasterBusinessLicense"]').value,
            additional_documents: wizardValidationFormStep5.querySelector('[name="formValidationAdditionalDocuments"]').value,
            front_pictureof_business_place: wizardValidationFormStep5.querySelector('[name="formValidationFrontPictureofBusinessPlace"]').value
        };
        validationStepper.next();
    });

    // Sales Associates / Reps Involved
    const FormValidation6 = FormValidation.formValidation(wizardValidationFormStep6, {
        fields: {
            formValidationLeadGen: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            },
            formValidationCloserOrTL: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                // eleInvalidClass: '',
                eleValidClass: '',
                rowSelector: '.col-sm-6'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        }
    }).on('core.form.valid', function () {
        step6Data = {
            lead_gen: wizardValidationFormStep6.querySelector('[name="formValidationLeadGen"]').value,
            closer_or_tl: wizardValidationFormStep6.querySelector('[name="formValidationCloserOrTL"]').value
        };
        validationStepper.next();
    });

    // Future Upsell Opportunity
    const FormValidation7 = FormValidation.formValidation(wizardValidationFormStep7, {
        fields: {
            formValidationAreyouExpectinganyUpsellfromthisMerchant: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            },
            formValidationPleaseSpecifytheBusinessNameorBusinessType: {
                validators: {
                    notEmpty: {
                        message: 'This is a required question'
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                // eleInvalidClass: '',
                eleValidClass: '',
                rowSelector: '.col-sm-6'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        }
    }).on('core.form.valid', function () {
        step7Data = {
            areyou_expectingany_upsell: wizardValidationFormStep7.querySelector('[name="formValidationAreyouExpectinganyUpsellfromthisMerchant"]').value,
            specifythe_business_nameor_business_type: wizardValidationFormStep7.querySelector('[name="formValidationPleaseSpecifytheBusinessNameorBusinessType"]').value
        };
    });

    // Get the form and all 'Next' buttons
    const form = document.getElementById('wizard-validation-form'); // Replace with your form's ID
    // const wizardValidationNext = document.querySelectorAll('.next-button'); // Assuming '.next-button' is the class for each "Next" button

    // Attach event listeners for each "Next" button
    wizardValidationNext.forEach(item => {
        // Listen for 'click' events on Next buttons
        item.addEventListener('click', event => {
            validateCurrentStep();
        });
    });

    // Prevent form submission and trigger validation on Enter key press
    form.addEventListener('keypress', event => {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent default submission
            validateCurrentStep();
        }
    });

    // Function to validate the current step
    function validateCurrentStep() {
        let isValid = false;

        switch (validationStepper._currentIndex) {
            case 0:
                isValid = FormValidation1.validate();
                break;
            case 1:
                isValid = FormValidation2.validate();
                break;
            case 2:
                isValid = FormValidation3.validate();
                break;
            case 3:
                isValid = FormValidation4.validate();
                break;
            case 4:
                isValid = FormValidation5.validate();
                break;
            case 5:
                isValid = FormValidation6.validate();
                break;
            case 6:
                isValid = FormValidation7.validate();
                break;
            default:
                break;
        }
    }


    wizardValidationPrev.forEach(item => {
        item.addEventListener('click', event => {
            switch (validationStepper._currentIndex) {
            case 6:
                validationStepper.previous();
                break;
            case 5:
                validationStepper.previous();
                break;
            case 4:
                validationStepper.previous();
                break;

            case 3:
                validationStepper.previous();
                break;

            case 2:
                validationStepper.previous();
                break;

            case 1:
                validationStepper.previous();
                break;

            case 0:

            default:
                break;
            }
        });
    });
}
})();
